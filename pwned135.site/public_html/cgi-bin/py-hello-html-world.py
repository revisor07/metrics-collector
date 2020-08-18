#!/usr/bin/python3

import time
import os
import cgi
import cgitb

#Print HTML header
print("Content-type:text/html\r\n\r\n")
print('<html>')
print('<head>')
print('<title>Hello Team Pwned Py</title>')
print('</head>')
print('<body>')
print('<h1 align=center>Hello Team Pwned Py</h1>\n')

print('<br><font size=+1>Hello World</font></br>')
print('<br>This program was generated at: ', time.ctime(), '</br>')
print(" \n")
print('<br>Your current IP address is: ', os.getenv("REMOTE_ADDR"), '</br>')
print("</body></html>")
#Print HTML footer


