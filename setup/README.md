As we go through the program, certain software and setup will recur.
This is a chance to have that setup ready when you need it.

The following is not the only setup that will work. 
There are many ways you can run and serve web applications.

And I expect opinions will vary on if it is the best way to do things.

However, the following is the setup that will be officially supported.
If you choose an alternative setup, we might be able to help you through
it, and we also reserve the rights to say you are on your own.

## Objective

Have your own setup ready for the summer program.

## Tasks

- Have a working Kali Virtual Machine
- Have a working docker setup (within the kali VM or otherwise)
- Have a report on how HTB web challenges are setup
using docker

## Resources
These resources are here to get you started. 
They might not provided everything you need to know,
or in a way that is most intuitive to you.
Feel encouraged to search around for more references/resources.

[Kali VM]
- [Instructions from a Gajabaar alumni](https://prasantadh.notion.site/Kali-Linux-on-VMware-58de004253f844d0b5248094a5decdbb)
Note that this instruction is a couple years dated, and uses VMWare on
ubuntu host system for the setup. Your base OS can be anything you choose,
and you can use VirtualBox as an alternative to VMWare. 
- [Instructions from Kali Linux distributors](https://www.kali.org/docs/virtualization/import-premade-virtualbox/) 
You can also look around for instructions for other platforms 
on the same website. May be look around for performance tips too.
- [Kali Linux Revealed Coursework](https://portal.offsec.com/courses/pen-103/books-and-videos/modules) 
this is a little "extra" IMO but you are welcome to go through it.
Can make you feel more comfortable with the OS.
- For Windows users, we have had WSL specific issues in the past. 
While we encourage you to explore the technology, 
we might NOT be officially able to debug your issues.


[Docker]
- [Kali Linux Documentation](https://www.kali.org/docs/containers/installing-docker-on-kali/) 
if you intend to use docker inside Kali VM
- [Docker Documentation](https://docs.docker.com/engine/install/ubuntu/) 
if you intend to use docker with your host OS.
Host OS doesn't need to be ubuntu as linked here.
You are welcome to search for documentation for your host OS on the website.
- [Docker getting started guide](https://docs.docker.com/get-started/)
- [Docker Playground](https://www.docker.com/101-tutorial/)
- [Containers From Scratch](https://www.youtube.com/watch?v=8fi7uSYlOdc)
this is more for those who want to know how docker is implemented
internally. If this feels too advanced, you can safely skip.

[HTB Web Challenges]
- [HTB Website](https://www.hackthebox.com)
- To understand the setup here, you need some more details on Dockerfile.
The [official documentation](https://docs.docker.com/engine/reference/builder/#:~:text=A%20Dockerfile%20is%20a%20text,can%20use%20in%20a%20Dockerfile%20.) can be helpful.
Fundamentally, a Dockerfile does what you would do on an OS.
The instructions on a Dockerfile will make more sense once
you are more familiar with linux systems.

## Submission

Once you have finished the task, 
you will need to send us the pull request with your work.
Sending in the pull request is the way to ensure that
your work gets visibility from the mentors, as well as
making sure your work is documented on your end and on 
our end.

For this task, your pull request must have the following three files:
- setup/\<github-id>/<htb-challenge-name>.md
- setup/\<github-id>/assets

Optionally, you can document your steps on how you got your setup working
and send that in as part of the submission.


## Miscellaneous [BANDIT]
In our experience, [overthewire bandit](https://overthewire.org/wargames/bandit/) 
is an absolutely great way to get familiar with both linux systems
as well as some cybersecurity quirks. You won't need to do them all
but we recommend that you get started and get a feel for it.
As such, we will officially support all bandit related queries 
on the discord channel from now until the first assignment
for the summer program is released.

You have the option to request for Bandit writup if you want over discord.
We prefer not to make this public as per guidance by the host.
We will also have an office hour about this at some point via
announcement on discord.

Extra tips:
- ideally, you would use the same name for zoom, discord, 
email, github, and all past+future submissions here.
- if this your first time doing these tasks, there is a lot to struggle
with. Start early. Take plenty of breaks. Revisit. Google. Youtube.
Medium. Ask us in the office hours and on the discord server.
Learn :)

