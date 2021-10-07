import requests, urllib, json
# curl   -X GET "https://api.nakala.fr/collections/10.34847%2Fnkl.4fe62di4/datas?page=1&limit=100" -H  "accept: application/json" -H "X-API-KEY: 0059a456-4692-40f7-c860-e0217d96d94e"
# https://api.nakala.fr/iiif/10.34847%2Fnkl.1e42tq70/d4bb2ca439e706c042d5319ed42931e99f49b5be/full/full/0/default.jpg
# https://api.nakala.fr/iiif/10.34847%2Fnkl.a4c5184o/eadfc5046bd11c76922c5bab6066698d1509b4d5/full/full/0/default.jpg

api_url = 'https://api.nakala.fr/'
api_key = '0059a456-4692-40f7-c860-e0217d96d94e'
collection = '10.34847%2Fnkl.4fe62di4'

def coll_id():
  headers = {'X-API-KEY': api_key}
  page = 1
  print("lettre\tfichier\tiiif")
  while True:
    params = {
      'limit': 25,
      'page': page,
    }
    url = api_url+'collections/'+ collection +'/datas'
    r = requests.request('GET', url, params=params, headers=headers)
    json = r.json()
    for lettre in json['data']:
      lettre_id = urllib.parse.quote(lettre['identifier'], safe='')
      lettre_title = lettre['metas'][0]['value']
      for file in lettre['files']:
        iiif = api_url + 'iiif/'+lettre_id+'/'+file['sha1']+'/full/full/0/default.jpg'
        print(lettre_title+'\t'+file['name']+'\t'+iiif)
    if page >= json['lastPage']:
      break
    page = page + 1

coll_id()
