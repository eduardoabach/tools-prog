from django.conf.urls import url
import view

SECRET_KEY = 'chave...'
DEBUG = True
ROOT_URLCONF = __name__

# a ordem é importante, as ordens mais genéricas devem ficar por ultimo
urlpatterns = [
    url(r'^$', view.hello), # 127.0.0.1:8000/
    url(r'^admin/', view.admin), # 127.0.0.1:8000/admin/*
    url(r'^.*$', view.page), # 127.0.0.1:8000/sadsdsd/asdsd, todos eles
]
