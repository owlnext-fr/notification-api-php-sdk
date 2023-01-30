<?php

namespace Owlnext\NotificationAPI\Router;

final class Routes
{

    public final const TEST_PING = "/api/docs.html";

    public final const TEST_PING_CONNECTED = "/api/users";

    public final const AUTHENTICATION_TOKEN = "/api/authentication_token";

    public final const AUTHENTICATION_REFRESH = "/api/token/refresh";

    public final const CONTACT_LIST = '/api/contacts';

    public final const CONTACT_DETAILS = '/api/contacts/{id}';

    public final const APPOINTMENT_LIST = '/api/appointments';

    public final const APPOINTMENT_DETAILS = '/api/appointments/{id}';

    public final const ATTACHMENT_LIST = '/api/attachments';

    public final const ATTACHMENT_DETAILS = '/api/attachments/{id}';

}