# using SendGrid's Python Library - https://github.com/sendgrid/sendgrid-python

#************************SENDGRID*****************************************
# import sendgrid

# sg = sendgrid.SendGridClient('prestados.app@gmail.com','prestados123')
# message = sendgrid.Mail()

# message.add_to("matialvarezs@gmail.com")
# message.set_from("prestados.app@gmail.com")
# message.set_subject("Sending with SendGrid is Fun")
# message.set_html("and easy to do anywhere, even with Python")

# resp = sg.send(message)          
# print resp              
#*************************************************************************

#***************************MAILGRUN*************************************
#mport requests
from requests import *

key = 'key-5205c8fd74f451a888e0a78d90adc828'
sandbox = 'YOUR SANDBOX URL HERE'
recipient = 'matialvarezs@gmail.com'

request_url = 'https://api.mailgun.net/v2/{0}/messages'.format(sandbox)
request = requests.post(request_url, auth=('api', key), data={
    'from': 'prestados.app@gmail.com',
    'to': recipient,
    'subject': 'Hello',
    'text': 'Hello from Mailgun'
})

print 'Status: {0}'.format(request.status_code)
print 'Body:   {0}'.format(request.text)
             
              
           