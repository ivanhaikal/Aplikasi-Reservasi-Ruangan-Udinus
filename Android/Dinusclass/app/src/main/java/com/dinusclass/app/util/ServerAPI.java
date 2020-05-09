package com.dinusclass.app.util;

public class ServerAPI {
    private static final String URL = "https://despiteful-taxis.000webhostapp.com/";

    ///file image
    public static final String URL_FILE_ACCOUNT = URL + "dinusclass/public/dataaccount/";
    public static final String URL_FILE_ROOM = URL + "dinusclass/public/dataroom/";

    ///account
    public static final String URL_LOGIN = URL + "dinusclass/android/login.php";
    public static final String URL_UPDATE_PASSWORD = URL + "dinusclass/android/update_password.php";

    ///ui
    public static final String URL_VIEW_ROOM = URL + "dinusclass/android/view_room.php";
    public static final String URL_VIEW_TIME = URL + "dinusclass/android/view_time.php";
    public static final String URL_VIEW_RESERVATION = URL + "dinusclass/android/view_reservation.php";
    public static final String URL_CREATE_RESERVATION = URL + "dinusclass/android/create_reservation.php";
    public static final String URL_LOAD_RESERVATION = URL + "dinusclass/android/load_reservation.php";
    public static final String URL_DELETE_RESERVATION = URL + "dinusclass/android/delete_reservation.php";
    public static final String URL_VIEW_NOTIFICATIONS = URL + "dinusclass/android/view_notifications.php";
}
