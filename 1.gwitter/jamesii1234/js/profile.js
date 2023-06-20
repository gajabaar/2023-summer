$(document).ready(function () {
  $(".unfollow-btn").click(function (e) {
    e.preventDefault();
    var unfollowBtn = $(this);
    var following = $(this).data("following");
    $.ajax({
      url: "unfollow.php",
      method: "POST",
      data: { following: following },
      success: function (response) {
        if (response === "success") {
          unfollowBtn.text("Follow");
          unfollowBtn.addClass("follow-btn");
          unfollowBtn.removeClass("unfollow-btn");
          location.reload();
        } else {
          console.log(response);
        }
      },
      error: function (xhr, status, error) {
        console.log(error);
      },
    });
  });

  $(".follow-btn").click(function (e) {
    e.preventDefault();
    var followBtn = $(this);
    var following = $(this).data("following");
    $.ajax({
      url: "follow.php",
      method: "POST",
      data: { username: following },
      success: function (response) {
        if (response === "success") {
          followBtn.text("Unfollow");
          followBtn.removeClass("follow-btn");
          followBtn.addClass("unfollow-btn");
          location.reload();
        } else {
          console.log(response);
        }
      },
      error: function (xhr, status, error) {
        console.log(error);
      },
    });
  });

  $(".like-btn").click(function (e) {
    e.preventDefault();

    var likeBtn = $(this);
    var gweetId = likeBtn.data("gweet-id");
    var liked = likeBtn.data("liked");

    if (liked === 1) {
      // User has already liked the gweet, so do nothing
      return;
    }

    $.ajax({
      url: "like.php",
      method: "POST",
      data: {
        gweet_id: gweetId,
      },
      success: function (response) {
        if (response === "success") {
          // Update the UI to reflect the like action
          var likesCount = parseInt(
            likeBtn.siblings("p").text().split(":")[1].trim()
          );
          likesCount++;
          likeBtn.siblings("p").text("Likes: " + likesCount);
          likeBtn.text("Liked");
          likeBtn.data("liked", 1);
          likeBtn.attr("disabled", true);
          location.reload();


          // Store the liked gweet in session
          if (typeof window.sessionStorage !== "undefined") {
            var likedGweets =
              JSON.parse(sessionStorage.getItem("liked_gweets")) || {};
            likedGweets[gweetId] = true;
            sessionStorage.setItem("liked_gweets", JSON.stringify(likedGweets));
          }
        } else {
          console.log(response);
        }
      },
      error: function (xhr, status, error) {
        console.log(error);
      },
    });
  });
});
