#!/usr/bin/env python

# Import modules for CGI handling
from os import environ
import cgi, cgitb
import random
import datetime
import random
import Cookie


form = cgi.FieldStorage()
name = form.getvalue('username')

expiration = datetime.datetime.now() + datetime.timedelta(days=30)
cookie = Cookie.SimpleCookie()
cookie["session"] = random.randint(1, 1000000000)
cookie["session"]["domain"] = ".jayconrod.com"
cookie["session"]["path"] = "/"
cookie["session"]["expires"] = \
  expiration.strftime("%a, %d-%b-%Y %H:%M:%S PST")

print("Content-type:text/html\r\n\r\n")

print("<h1>Python Session 1 Page</h1><hr />")
print('<b>Name: </b>', name)
print("<br>")

print("<a href=\"/cgi-bin/py-sessions-2.py\" style=\"display:inline-block;margin-top:20px;\">Session Page 2</a></br>")
print("<a href=\"/cgi-bin/py-state-demo.py\" style=\"display:inline-block;margin-top:20px;\">Python CGI Form</a></br>\n")
print("<br>")
print("<form style=\"margin-top:30px\" action=\"/cgi-bin/php-destroy-session.php\" method=\"get\">")
print("<button type=\"submit\">Destroy Session</button></form>")
