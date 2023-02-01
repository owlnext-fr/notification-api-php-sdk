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
    public final const TRANSPORT_LIST = '/api/transports';
    public final const TRANSPORT_DETAILS = '/api/transports/{id}';
    public final const USER_LIST = '/api/users';
    public final const USER_DETAILS = '/api/users/{id}';
    public final const NOTIFICATION_TYPE_LIST = '/api/notification-types';
    public final const NOTIFICATION_TYPE_DETAILS = '/api/notification-types/{id}';
    public final const NOTIFICATION_STATUS_LIST = '/api/notification-status';
    public final const NOTIFICATION_STATUS_DETAILS = '/api/notification-status/{id}';
    public final const NOTIFICATION_STATUS_DETAILS_LAST_STATUS = '/api/notifications/{id}/last_status';
    public final const NOTIFICATION_STATUS_LIST_STATUS_HISTORIES = '/api/notifications/{id}/status_histories';
    public final const LETTER_OPTION_LIST = '/api/letter-option';
    public final const LETTER_OPTION_DETAILS = '/api/letter-option/{id}';
    public final const SIGNATURE_REQUEST_LIST = '/api/signature-requests';
    public final const SIGNATURE_REQUEST_DETAILS = '/api/signature-requests/{id}';
    public final const NOTIFICATION_LIST = '/api/notifications';
    public final const NOTIFICATION_DETAILS = '/api/notifications/{id}';
    public final const NOTIFICATION_DETAILS_LAST_STATUS = '/api/notifications/{id}/last_status';
    public final const NOTIFICATION_LIST_STATUS_HISTORIES = '/api/notifications/{id}/status_histories';

}