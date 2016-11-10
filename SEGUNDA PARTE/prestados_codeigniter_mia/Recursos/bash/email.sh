#!/bin/bash
curl -s --user 'api:key-5205c8fd74f451a888e0a78d90adc828' \
    https://api.mailgun.net/v3/sandboxdd718c5d3831470581c443f1e1024888.mailgun.org/messages \
    -F from='Excited User <pestados.app@gmail.com>' \
    -F to=alice@example.com \
    -F to=bob@example.com \
    -F recipient-variables='{"bob@example.com": {"first":"Bob", "id":1}, "alice@example.com": {"first":"Alice", "id": 2}}' \
    -F subject='Hey, %recipient.first%' \
    -F text='If you wish to unsubscribe, click http://mailgun/unsubscribe/%recipient.id%'