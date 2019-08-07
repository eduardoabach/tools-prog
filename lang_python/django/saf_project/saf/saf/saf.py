from django.http import HttpResponse

def call_form(request):
    return HttpResponse('Django na prática - Hello World!')

def send(request):
    
    #log init

    if not is_valid_recaptcha():
        return False
    if not is_valid_recaptcha():
        return False

    return True

def is_valid_recaptcha(request):
    #log result
    return True

def validade_json_schema(request):
    #log result
    return True
