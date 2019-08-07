from django.http import HttpResponse

def hello(request):
    return HttpResponse('Django na prática - Hello World!')

def page(request):
    return HttpResponse('page.')

def admin(request):
    return HttpResponse('Admin...')