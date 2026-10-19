package com.example.project1861.Activity;

import android.os.Bundle;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.example.project1861.Adapter.ColorAdapter;
import com.example.project1861.Adapter.SizeAdapter;
import com.example.project1861.Adapter.SliderAdapter;
import com.example.project1861.Domain.ItemsDomain;
import com.example.project1861.Domain.SliderItems;
import com.example.project1861.Helper.ManagmentCart;
import com.example.project1861.databinding.ActivityDetailBinding;

import java.util.ArrayList;

public class DetailActivity extends BaseActivity {
    private ActivityDetailBinding binding; // View binding for the activity
    private ItemsDomain object; // Item details to be displayed
    private ManagmentCart managmentCart; // Helper class for managing the cart
    private int numberOrder = 1; // Initial order quantity

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        binding = ActivityDetailBinding.inflate(getLayoutInflater()); // Initialize view binding
        setContentView(binding.getRoot()); // Set the content view to the root of the binding

        managmentCart = new ManagmentCart(this); // Initialize cart management

        getBundles(); // Retrieve item details from the intent
        initBanners(); // Initialize the image slider
        initSize(); // Initialize the size options
        initColor(); // Initialize the color options
    }

    // Initialize the color options for the item
    private void initColor() {
        ArrayList<String> list = new ArrayList<>();
        list.add("#006fc4"); // Blue
        list.add("#daa048"); // Gold
        list.add("#398d41"); // Green
        list.add("#0c3c72"); // Dark Blue
        list.add("#829db5"); // Light Blue

        // Additional setup for the color adapter can be done here
    }

    // Initialize the size options for the item
    private void initSize() {
        ArrayList<String> list = new ArrayList<>();
        list.add("S"); // Small
        list.add("M"); // Medium
        list.add("L"); // Large
        list.add("XL"); // Extra Large
        list.add("XXL"); // Extra Extra Large

        binding.recyclerSize.setAdapter(new SizeAdapter(list)); // Set the size adapter
        binding.recyclerSize.setLayoutManager(new LinearLayoutManager(this, LinearLayoutManager.HORIZONTAL, false)); // Set layout manager for horizontal scrolling
    }

    // Initialize the image slider with the item's pictures
    private void initBanners() {
        ArrayList<SliderItems> sliderItems = new ArrayList<>();
        for (int i = 0; i < object.getPicUrl().size(); i++) {
            sliderItems.add(new SliderItems(object.getPicUrl().get(i))); // Add each picture URL to the slider items
        }
        binding.viewpagerSlider.setAdapter(new SliderAdapter(sliderItems, binding.viewpagerSlider)); // Set the slider adapter
        binding.viewpagerSlider.setClipToPadding(false); // Allow views to draw outside their padding
        binding.viewpagerSlider.setClipChildren(false); // Allow children to draw outside their bounds
        binding.viewpagerSlider.setOffscreenPageLimit(3); // Set offscreen page limit for better performance
        binding.viewpagerSlider.getChildAt(0).setOverScrollMode(RecyclerView.OVER_SCROLL_NEVER); // Disable overscroll mode
    }

    // Retrieve item details from the intent and update the UI
    private void getBundles() {
        object = (ItemsDomain) getIntent().getSerializableExtra("object"); // Get the item details from the intent
        binding.titleTxt.setText(object.getTitle()); // Set the item title
        binding.priceTxt.setText("₱" + object.getPrice()); // Set the item price
        binding.ratingBar.setRating((float) object.getRating()); // Set the item rating
        binding.ratingTxt.setText(object.getRating() + " Rating"); // Set the rating text
        binding.descriptionTxt.setText(object.getDescription()); // Set the item description

        // Set click listener for the Add to Cart button
        binding.AddtoCartBtn.setOnClickListener(v -> {
            object.setNumberinCart(numberOrder); // Set the order quantity
            managmentCart.insertItem(object); // Add the item to the cart
        });

        // Set click listener for the Back button
        binding.backBtn.setOnClickListener(v -> finish()); // Close the activity
    }
}
