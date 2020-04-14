package com.dinusclass.app.model;

public class ModelRoom {
    private String code, name, capacity, image, type;

    public ModelRoom(String code, String name, String capacity, String image, String type) {
        this.code = code;
        this.name = name;
        this.capacity = capacity;
        this.image = image;
        this.type = type;
    }

    public String getCode() {
        return code;
    }

    public String getName() {
        return name;
    }

    public String getCapacity() {
        return capacity;
    }

    public String getImage() {
        return image;
    }

    public String getType() {
        return type;
    }
}
