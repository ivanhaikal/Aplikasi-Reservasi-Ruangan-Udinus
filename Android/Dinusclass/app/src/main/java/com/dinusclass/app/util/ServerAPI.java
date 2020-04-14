package com.dinusclass.app.util;

public class ServerAPI {
    private static final String URL = "http://10.0.2.2/";

    ///file image
    public static final String URL_FILE_ACCOUNT = URL + "dinusclass/public/dataaccount/";
    public static final String URL_FILE_ROOM = URL + "dinusclass/public/dataroom/";

    ///account
    public static final String URL_LOGIN = URL + "dinusclass/android/login.php";
    public static final String URL_UPDATE_PASSWORD = URL + "dinusclass/android/update_password.php";

    ///room
    public static final String URL_VIEW_ROOM = URL + "dinusclass/android/view_room.php";
}
