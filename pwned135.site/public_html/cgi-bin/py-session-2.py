#!/usr/bin/python3

# Import modules for CGI handling
from os import environ
from http import cookies
import cgi, cgitb, os

user_id = None

try:
    cookie = cookies.SimpleCookie(os.environ["HTTP_COOKIE"])
    user_id = cookie["session"]["comment"]
except (cookies.CookieError, KeyError):
    user_id = "session cookie not set!"


print("Content-type:text/html\r\n\r\n")

print("<h1>Python Session 2 Page</h1><hr />")
print(cookies.SimpleCookie(os.environ["HTTP_COOKIE"]))
print("<b>Name: </b>", user_id)
print("<br>")

print("<a href=\"/py-session-1.py\" style=\"display:inline-block;margin-top:20px;\">Session Page 1</a></br>")
print("<a href=\"/py-state-demo.py\" style=\"display:inline-block;margin-top:20px;\">Python CGI Form</a></br>\n")
print("<br>")
print("<input type = \"submit\" value = \"Destroy Session\"></form>")
