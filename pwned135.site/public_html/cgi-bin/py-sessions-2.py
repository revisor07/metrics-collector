#!/usr/bin/env python

# Import modules for CGI handling
from os import environ
import cgi, cgitb, os
import Cookie


print("Content-type:text/html\r\n\r\n")

print("<h1>Python Session 2 Page</h1><hr />")
user_id = None
try:
    cookie = Cookie.SimpleCookie(os.environ["HTTP_COOKIE"])
    user_id = "session = " + cookie["session"].name
except (Cookie.CookieError, KeyError):
    user_id = "session cookie not set!"
print("<b>Name: </b>", user_id)
print("<br>")

print("<a href=\"/cgi-bin/py-sessions-1.py\" style=\"display:inline-block;margin-top:20px;\">Session Page 1</a></br>")
print("<a href=\"/cgi-bin/py-state-demo.py\" style=\"display:inline-block;margin-top:20px;\">Python CGI Form</a></br>\n")
print("<br>")
print("<form style=\"margin-top:30px\" action=\"/cgi-bin/php-destroy-session.php\" method=\"get\">")
print("<button type=\"submit\">Destroy Session</button></form>")
