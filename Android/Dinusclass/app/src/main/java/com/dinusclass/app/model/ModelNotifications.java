package com.dinusclass.app.model;

public class ModelNotifications {
    private String id, roomId, type, name, image, date, timeId, time;

    public ModelNotifications(String id, String roomId, String type, String name, String image, String date, String timeId, String time) {
        this.id = id;
        this.roomId = roomId;
        this.type = type;
        this.name = name;
        this.image = image;
        this.date = date;
        this.timeId = timeId;
        this.time = time;
    }

    public String getId() {
        return id;
    }

    public String getRoomId() {
        return roomId;
    }

    public String getType() {
        return type;
    }

    public String getName() {
        return name;
    }

    public String getImage() {
        return image;
    }

    public String getDate() {
        return date;
    }

    public String getTimeId() {
        return timeId;
    }

    public String getTime() {
        return time;
    }
}
