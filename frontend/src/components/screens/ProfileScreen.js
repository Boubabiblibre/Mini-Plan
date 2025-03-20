import React from 'react';
import { View, Text, Image, TouchableOpacity, StyleSheet } from 'react-native';
import styles from '../../styles/ProfileStyles';
import { Ionicons } from '@expo/vector-icons';

const ProfileScreen = ({ navigation }) => {
  return (
    <View style={styles.container}>
      
      {/* Profile Picture & Info */}
      <View style={styles.profileSection}>
        
        <TouchableOpacity style={styles.cameraIcon}>
          <Ionicons name="camera" size={18} color="black" />
        </TouchableOpacity>
        <Text style={styles.userName}>JOHN</Text>
        <Text style={styles.userEmail}>jhon2140@gmail.com</Text>
        <TouchableOpacity style={styles.editButton}>
          <Text style={styles.editText}>Edit Profile</Text>
        </TouchableOpacity>
      </View>
      
      {/* Logout Button */}
      <TouchableOpacity style={styles.logoutButton}>
        <Text style={styles.logoutText}>LOG OUT</Text>
      </TouchableOpacity>
    </View>
  );
};

export default ProfileScreen;
