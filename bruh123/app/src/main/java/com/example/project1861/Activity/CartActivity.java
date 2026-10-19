package com.example.project1861.Activity;

import android.os.Bundle;
import android.view.View;import androidx.recyclerview.widget.LinearLayoutManager;

import com.example.project1861.Adapter.CartAdapter;
import com.example.project1861.Helper.ManagmentCart;
import com.example.project1861.databinding.ActivityCartBinding;public class CartActivity extends BaseActivity {
    private ActivityCartBinding binding;
    private ManagmentCart managmentCart;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        binding = ActivityCartBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());

        // Initialize cart management helper
        managmentCart = new ManagmentCart(this);

        // Initial setup
        calculatorCart();
        setVariable();
        initCartList();

        // Handle "Save Cart" button click
        binding.saveCartButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Send cart data to Firebase and reset the cart
                managmentCart.sendCartToFirebaseAndReset();
                // Refresh the cart list view
                initCartList();
                // Recalculate cart totals
                calculatorCart();
            }
        });
    }

    // Initialize the cart list RecyclerView
    private void initCartList() {
        // Show/hide empty cart message based on cart - JLR
        if (managmentCart.getListCart().isEmpty()) {
            binding.emptyTxt.setVisibility(View.VISIBLE);
            binding.scrollViewCart.setVisibility(View.GONE);
        } else {
            binding.emptyTxt.setVisibility(View.GONE);
            binding.scrollViewCart.setVisibility(View.VISIBLE);
        }

        // Set up RecyclerView with LinearLayoutManager and CartAdapter
        binding.cartView.setLayoutManager(new LinearLayoutManager(this, LinearLayoutManager.VERTICAL, false));
        binding.cartView.setAdapter(new CartAdapter(managmentCart.getListCart(), this, () -> calculatorCart()));
    }

    // click listener for the back button - JLR
    private void setVariable() {
        binding.backBtn.setOnClickListener(v -> finish());
    }

    // Delivery Fee = 0 if the cart is empty - JLR
    private void calculatorCart() {
        double delivery = 0;
        if (managmentCart.getListCart().isEmpty()) {
            delivery = 0;
        } else {
            delivery = 250;
        }

        // Calculate total with delivery fee - JLR
        double total = Math.round((managmentCart.getTotalFee() + delivery) * 100.0) / 100.0;
        // Calculate total of items only - JLR
        double itemTotal = Math.round((managmentCart.getTotalFee() * 100.0)) / 100.0;

        // Update text views with calculated totals
        binding.totalFeeTxt.setText("₱" + itemTotal);
        binding.deliveryTxt.setText("₱" + delivery);
        binding.totalTxt.setText("₱" + total);
    }
}