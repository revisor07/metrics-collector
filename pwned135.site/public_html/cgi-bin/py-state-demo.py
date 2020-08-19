#!/usr/bin/python3

import json
import os
import cgi
import cgitb


print("Content-type:text/html\r\n\r\n")

print("<h1 align='center'>Session Test</h1><hr />")
print("<label>CGI using Python</label>")

print("<form action = \"/cgi-bin/py-sessions-1.py\" method = \"post\" target = \"_blank\">")
print("<label for=\"username\">What is your name?</label>")
print("<input type=\"text\"  id=\"username\" name = \"username\"></br>")
print("<input type = \"submit\" value = \"Test Sessioning\"></form>")


print("<a href=\"/\" style=\"display:inline-block;margin-top:20px;\">Home</a>")
print("</form>")
print("</body>")
print("</html>")



