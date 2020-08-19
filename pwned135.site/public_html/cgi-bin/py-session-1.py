#!/usr/bin/env python

# Import modules for CGI handling
from os import environ
import sha, time, Cookie, os, shelve
import cgi, cgitb
import random


form = cgi.FieldStorage()
name = form.getvalue('username')

cookie = Cookie.SimpleCookie()
string_cookie = os.environ.get('HTTP_COOKIE')

if not string_cookie:
    sid = sha.new(repr(time.time())).hexdigest()
    cookie['sid'] = sid
    message = 'New session'
else:
    cookie.load(string_cookie)
    sid = cookie['sid'].value
cookie['sid']['expires'] = name

# The shelve module will persist the session data
# and expose it as a dictionary
os.environ['DOCUMENT_ROOT'] = '.'
session_dir = os.environ['DOCUMENT_ROOT'] + '/tmp/.session'
session = shelve.open('%s/sess_%s' % (session_dir, sid), writeback=True)

# Retrieve last visit time from the session
lastvisit = session.get('lastvisit')
if lastvisit:
    message = 'Welcome back. Your last visit was at ' + \
      time.asctime(time.gmtime(float(lastvisit)))
# Save the current time in the session
session['lastvisit'] = repr(time.time())

print("Content-type:text/html\r\n\r\n")

print("<h1>Python Session 1 Page</h1><hr />")
print('<b>Name: </b>', name)
print("<br>")

print("<a href=\"/cgi-bin/py-session-2.py\" style=\"display:inline-block;margin-top:20px;\">Session Page 2</a></br>")
print("<a href=\"/cgi-bin/py-state-demo.py\" style=\"display:inline-block;margin-top:20px;\">Python CGI Form</a></br>\n")
print("<br>")
print("<input type = \"submit\" value = \"Destroy Session\"></form>")
