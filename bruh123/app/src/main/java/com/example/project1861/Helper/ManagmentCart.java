package com.example.project1861.Helper;

import android.content.Context;
import android.widget.Toast;

import com.example.project1861.Domain.ItemsDomain;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

public class ManagmentCart {

    private Context context;
    private TinyDB tinyDB;

    public ManagmentCart(Context context) {
        this.context = context;
        this.tinyDB = new TinyDB(context);
    }

    public void insertItem(ItemsDomain item) {
        ArrayList<ItemsDomain> listItem = getListCart();
        boolean existAlready = false;
        int n = 0;
        for (int y = 0; y < listItem.size(); y++) {
            if (listItem.get(y).getTitle().equals(item.getTitle())) {
                existAlready = true;
                n = y;
                break;
            }
        }
        if (existAlready) {
            listItem.get(n).setNumberinCart(item.getNumberinCart());
        } else {
            listItem.add(item);
        }
        tinyDB.putListObject("CartList", listItem);
        Toast.makeText(context, "Added to your Cart", Toast.LENGTH_SHORT).show();
    }

    public ArrayList<ItemsDomain> getListCart() {
        return tinyDB.getListObject("CartList");
    }

    public void minusItem(ArrayList<ItemsDomain> listItem, int position, ChangeNumberItemsListener changeNumberItemsListener) {
        if (listItem.get(position).getNumberinCart() == 1) {
            listItem.remove(position);
        } else {
            listItem.get(position).setNumberinCart(listItem.get(position).getNumberinCart() - 1);
        }
        tinyDB.putListObject("CartList", listItem);
        changeNumberItemsListener.changed();
    }

    public void plusItem(ArrayList<ItemsDomain> listItem, int position, ChangeNumberItemsListener changeNumberItemsListener) {
        listItem.get(position).setNumberinCart(listItem.get(position).getNumberinCart() + 1);
        tinyDB.putListObject("CartList", listItem);
        changeNumberItemsListener.changed();
    }

    public Double getTotalFee() {
        ArrayList<ItemsDomain> listItem2 = getListCart();
        double fee = 0;
        for (int i = 0; i < listItem2.size(); i++) {
            fee = fee + (listItem2.get(i).getPrice() * listItem2.get(i).getNumberinCart());
        }
        return fee;
    }

    // New method to send cart items to Firebase and reset cart
    public void sendCartToFirebaseAndReset() {
        ArrayList<ItemsDomain> cartList = getListCart();
        if (cartList.isEmpty()) {
            Toast.makeText(context, "Cart is empty", Toast.LENGTH_SHORT).show();
            return;
        }

        DatabaseReference databaseReference = FirebaseDatabase.getInstance().getReference("CartItems");
        String userId = FirebaseAuth.getInstance().getCurrentUser().getUid(); // Get the current user's ID

        Map<String, Object> cartItemsMap = new HashMap<>();
        for (ItemsDomain item : cartList) {
            Map<String, Object> itemMap = new HashMap<>();
            itemMap.put("title", item.getTitle());
            itemMap.put("price", item.getPrice());
            itemMap.put("numberInCart", item.getNumberinCart());
            cartItemsMap.put(item.getTitle(), itemMap);
        }

        databaseReference.child(userId).setValue(cartItemsMap)
                .addOnSuccessListener(aVoid -> {
                    // Successfully saved to Firebase
                    Toast.makeText(context, "Cart saved to Firebase", Toast.LENGTH_SHORT).show();
                    // Clear the cart
                    tinyDB.putListObject("CartList", new ArrayList<ItemsDomain>());
                })
                .addOnFailureListener(e -> {
                    // Failed to save to Firebase
                    Toast.makeText(context, "Failed to save cart to Firebase", Toast.LENGTH_SHORT).show();
                });
    }
}
