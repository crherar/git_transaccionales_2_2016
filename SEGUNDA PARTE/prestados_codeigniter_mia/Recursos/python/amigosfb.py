import facebook

token = 'CAAXUu1xNsTMBAE4AIMxDjEe74u2fzPxoZCXhZBhZB1YQlb3IiOwfvrOQB3zFBqvHUcOrwSZBlsZCNwl0Xa05wbywZBesaRQIRbyWV4CtryJZAYbKzDu6aKZBZBvoU1kZCnF0PLnrxMB9x12ZCjvhkcS0SGZBtZADfO9Fn17M1Ohd2IZAhjQgQEUdqvXREkZBqJA88C8QYyXsxQhZCO2ZCfgZDZD'

graph = facebook.GraphAPI(token)
profile = graph.get_object("me")
friends = graph.get_connections("me", "friends")

friend_list = [friend['name'] for friend in friends['data']]

print friend_list