import React from 'react';
import { View, Text, Image, TouchableOpacity, StyleSheet } from 'react-native';
import HomeStyles from '../../styles/HomeStyles';

const HomeScreen = ({ navigation }) => {
  return (
    <View style={HomeStyles.container}>
      
      <View style={HomeStyles.introContainer}>
        <Text style={HomeStyles.introTitle}>Gérez facilement vos abonnements en famille</Text>
        <Text style={HomeStyles.introText}>Gardez le contrôle de vos paiements et évitez les mauvaises surprises</Text>
      </View>
      
      <TouchableOpacity style={HomeStyles.button} onPress={() => navigation.navigate('Login')}>
        <Text style={HomeStyles.buttonText}>CONNEXION</Text>
      </TouchableOpacity>
      
      <TouchableOpacity style={[HomeStyles.button, HomeStyles.secondaryButton]} onPress={() => navigation.navigate('Register')}>
        <Text style={HomeStyles.buttonText}>INSCRIPTION</Text>
      </TouchableOpacity>

      <TouchableOpacity style={[HomeStyles.button, HomeStyles.secondaryButton]} onPress={() => navigation.navigate('Dashboard')}>
        <Text style={HomeStyles.buttonText}>DASHBOARD</Text>
      </TouchableOpacity>

      <TouchableOpacity style={[HomeStyles.button, HomeStyles.secondaryButton]} onPress={() => navigation.navigate('Profile')}>
        <Text style={HomeStyles.buttonText}>PROFIL</Text>
      </TouchableOpacity>
    </View>
  );
};

export default HomeScreen;