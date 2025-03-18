import React from 'react';
import { View, Text, Image, TouchableOpacity, StyleSheet } from 'react-native';
import ProfileStyles from '../../styles/ProfileStyles';
import { Ionicons } from '@expo/vector-icons';

const ProfileScreen = ({ navigation }) => {
  return (
    <View style={ProfileStyles.container}>
      {/* Header */}
      <View style={ProfileStyles.header}>
        <TouchableOpacity onPress={() => navigation.goBack()}>
          <Ionicons name="arrow-back" size={24} color="white" />
        </TouchableOpacity>
        <Text style={ProfileStyles.title}>My Profile</Text>
        <TouchableOpacity>
          <Ionicons name="settings" size={24} color="white" />
        </TouchableOpacity>
      </View>
      
      {/* Profile Picture & Info */}
      <View style={ProfileStyles.profileSection}>
        
        <TouchableOpacity style={ProfileStyles.cameraIcon}>
          <Ionicons name="camera" size={18} color="black" />
        </TouchableOpacity>
        <Text style={ProfileStyles.userName}>JOHN</Text>
        <Text style={ProfileStyles.userEmail}>jhon2140@gmail.com</Text>
        <TouchableOpacity style={ProfileStyles.editButton}>
          <Text style={ProfileStyles.editText}>Edit Profile</Text>
        </TouchableOpacity>
      </View>
      
      {/* Logout Button */}
      <TouchableOpacity style={ProfileStyles.logoutButton}>
        <Text style={ProfileStyles.logoutText}>LOG OUT</Text>
      </TouchableOpacity>
    </View>
  );
};

export default ProfileScreen;
