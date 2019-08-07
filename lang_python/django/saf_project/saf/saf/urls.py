'''
    Django urls for saf project.
'''

from django.conf.urls import url
import saf

urlpatterns = [
    url(r'^form', saf.form), # 127.0.0.1:8000/
    url(r'^send', saf.send)
]
