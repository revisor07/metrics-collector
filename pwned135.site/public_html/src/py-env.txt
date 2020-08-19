#!/usr/bin/python3

import cgi
import cgitb
import os

print("Content-type: text/html\r\n\r\n")

print("<h1 align='center'>Environment Variables</h1><hr />")
cgi.print_environ()
