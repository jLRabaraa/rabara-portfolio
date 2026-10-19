package com.example.project1861.Activity;

import android.content.Intent;
import android.os.Bundle;

import com.example.project1861.databinding.ActivityIntroBinding;

public class IntroActivity extends BaseActivity {
    private ActivityIntroBinding binding; // View binding object for the activity layout
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        binding = ActivityIntroBinding.inflate(getLayoutInflater()); // Inflate the layout
        setContentView(binding.getRoot()); // Set the content view


        // Set an onClickListener for the "Start" button to launch the MainActivity
        binding.startBtn.setOnClickListener(v -> {
            startActivity(new Intent(this, MainActivity.class));
            finish(); // Close the IntroActivity
        });

    }
}