package com.example.project1861.Domain;

public class CategoryDomain {
    private String title;
    private String picUrl;
    private String linkUrl;

    public CategoryDomain() {
        // Default constructor required for calls to DataSnapshot.getValue(CategoryDomain.class)
    }

    public CategoryDomain(String title, String picUrl, String linkUrl) {
        this.title = title;
        this.picUrl = picUrl;
        this.linkUrl = linkUrl;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public String getPicUrl() {
        return picUrl;
    }

    public void setPicUrl(String picUrl) {
        this.picUrl = picUrl;
    }

    public String getLinkUrl() {
        return linkUrl;
    }

    public void setLinkUrl(String linkUrl) {
        this.linkUrl = linkUrl;
    }
}
