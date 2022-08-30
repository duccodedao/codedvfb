import requests

url = "https://api.cloudflare.com/client/v4/zones"
data = {
    'account': "07b3aa73f42846ad738267d98427fadd",
    'name': "okla.ml",
    "jump_start": True
}
header = {
    'Content-Type': "application/json",
    'X-Auth-Key': "3ede873e99d36647dea59ec7671def7f1ccc9",
    'X-Auth-Email': "thattinh14122@gmail.com"
}


a = requests.post(url,data=data, headers=header).text
print(a)