<? /*

# NuSOAP service configuration settings file

[GeneralSettings]
AvailableServices[]=bcsoapsearch

# enable or disable NuSOAP server
EnableSOAP=true

# enable or disable NuSOAP server logging
EnableLog=true

# example service bcsoapsearch
[Service_bcsoapsearch]
# name of the service
ServiceName=BcSoapSearch
# namespace of the service
ServiceNamespace=urn:bcsoapsearch
# extensions which contain the methods
# the eZ publish extension nusoap contains a NuSOAP extension called helloworld
# SOAPExtensions[]
SOAPExtensions[bcsoapsearch]=bcsoapsearch

*/ ?>