
import redis as redis

from flask import Flask
app = Flask(__name__)
queue_name = 'vote_opt'

def redis_cli():
    return redis.Redis(host='172.17.0.1', port='6379', password='', db='0')

def redis_vote_status(id):
    r_cli = redis_cli()
    return r_cli.get(queue_name+'_'+id)

def redis_vote(id):
    r_cli = redis_cli()
    r_cli.incr(queue_name+'_'+id)


@app.route("/votes/<string:id_chose_vote>")
def vote_status(id_chose_vote):
    return "Votes %s" % redis_vote_status(id_chose_vote) 

@app.route("/votes/do/<string:id_chose_vote>")
def vote_set(id_chose_vote):
    redis_vote(id_chose_vote)
    # return "Computed Vote to %s" % id_chose_vote
    return ""

#http://127.0.0.1:5000/votes/1
#http://127.0.0.1:5000/votes/2
#http://127.0.0.1:5000/votes/do/1
#http://127.0.0.1:5000/votes/do/2
#https://hackernoon.com/making-a-web-voting-app-handling-245-million-votes-with-0-12-e59d5ec6a030
#with AOF persistence
#https://pythonspot.com/flask-hello-world/

# if __name__ == '__main__':
#     app.run(port=80)
if __name__ == '__main__':
    app.run(host='0.0.0.0', port=80)