#!C:/Program Files/Python311/python.exe
import os

#& Отправка заголовка
print("Content-Type: text/html\r\n\r")

#& Дальше контент

def get_query():
    query = {}
    environ = os.environ['QUERY_STRING'].split('&')
    for q in environ:
        if (q != ''):
            q = q.split('=')
            query[q[0]] = q[1]
    return query


def main():
    query = get_query()
    # print(os.environ)

    print('<html><head>')
    print('<title>' + 'Meow' + '</title>')
    print('<meta name="robots" content="noindex, nofollow">')
    print('</head>')
    print('<body>')
    
    print(f'<h3>whoah!</h3>')

    baseurl = 'http://terabozik.tk'
    url = baseurl + '/smth'
    if 'name' in query:
        print(f"<h1>Hello, {query['name']}</h1>")
    else:
        url += '?name=user'
    print(f'<a href={url}>{url}</a>')
    print(f'<br><a href={baseurl}>{baseurl}</a>')
    print("</body></html>")

main()
