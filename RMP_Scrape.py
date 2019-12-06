import requests,json

def webscrape(prof_name):
	cookies = {
	    'ajs_user_id': 'null',
	    'ajs_group_id': 'null',
	    'ajs_anonymous_id': '%228460831f-f6f7-4c76-9fc6-e20cae7a1d59%22',
	    '_ga': 'GA1.2.1660642131.1570313209',
	    '_gaexp': 'GAX1.2.lePbSuhBSr2OaIprXhGiBQ.18286.0',
	    '_gid': 'GA1.2.169126026.1575197049',
	    '_gat': '1',
	}

	headers = {
	    'Connection': 'keep-alive',
	    'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36',
	    'Accept': '*/*',
	    'Sec-Fetch-Site': 'same-site',
	    'Sec-Fetch-Mode': 'no-cors',
	    'Referer': 'https://www.ratemyprofessors.com/mobile/professor_search',
	    'Accept-Encoding': 'gzip, deflate, br',
	    'Accept-Language': 'en-US,en;q=0.9',
	    'If-None-Match': '"N2QyY2YyNGM1NjgwMDAwMFNvbHI="',
	    'If-Modified-Since': 'Sun, 01 Dec 2019 12:00:56 GMT',
	}

	params = (
	    ('solrformat', 'true'),
	    ('rows', ['20', '20']),
	    ('wt', 'json'),
	    ('json.wrf', 'noCB'),
	    ('callback', 'noCB'),
	    ('q', prof_name),
	    ('qf', 'teacherfirstname_t^2000 teacherlastname_t^2000 teacherfullname_t^2000 teacherfullname_autosuggest'),
	    ('bf', 'pow(total_number_of_ratings_i,2.1)'),
	    ('sort', 'score desc'),
	    ('defType', 'edismax'),
	    ('siteName', 'rmp'),
	    ('group', 'off'),
	    ('group.field', 'content_type_s'),
	    ('group.limit', '20'),
	    ('fq', 'schoolid_s:1112'),
	)

	response = requests.get('https://solr-aws-elb-production.ratemyprofessors.com//solr/rmp/select/', headers=headers, params=params, cookies=cookies)

	str = response.text
	ratingidx = str.find('averageratingscore_rf')
	start = ratingidx + len('averageratingscore_rf') + 2
	rating = str[start:start+3]
	difficultyidx = str.find('averageeasyscore_rf')
	start = difficultyidx + len('averageeasyscore_rf') + 2
	difficulty = str[start:start+3]
	tagsidx = str.find('tag_s_mv')
	start = str.find('[',tagsidx)
	stop = str.find(']',tagsidx)
	tags = str[start:stop+1]
	print(rating,difficulty,tags)
	x = prof_name.split()
	with open('CS_teachers_data.txt', 'a') as myfile:
		myfile.write("%s %s %s %s %s\n"%(x[0], x[1], rating, difficulty, tags))

def main():
	f = open('CS_teachers.txt', 'r')
	for name in f:
		webscrape(name)		
main()
