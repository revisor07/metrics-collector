#!/usr/bin/python3

# Import modules for CGI handling
from os import environ
import cgi, cgitb
import random
import datetime
import random



print("Content-type:text/html\r\n\r\n")

print("<html><head><title>Perl Session Destroyed</title></head><body>")
print("<h1>Session Destroyed</h1>")
print("<a href=\"/cgi-bin/py-state-demo.py\">Back to the Py CGI Form</a><br />")
print("<a href=\"/cgi-bin/py-sessions-1.py\">Back to Page 1</a><br />")
print("<a href=\"/cgi-bin/py-sessions-2.py\">Back to Page 2</a>")
print("</body></html>")
