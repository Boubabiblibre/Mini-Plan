import React from 'react';
import { View, Text, Image, TouchableOpacity, StyleSheet } from 'react-native';
import styles from '../../styles/HomeStyles';

const HomeScreen = ({ navigation }) => {
  return (
    <View style={styles.container}>
      
      <View style={styles.introContainer}>
        <Text style={styles.introTitle}>Gérez facilement vos abonnements en famille</Text>
        <Text style={styles.introText}>Gardez le contrôle de vos paiements et évitez les mauvaises surprises</Text>
      </View>
      
      <TouchableOpacity style={styles.button} onPress={() => navigation.navigate('Login')}>
        <Text style={styles.buttonText}>CONNEXION</Text>
      </TouchableOpacity>
      
      <TouchableOpacity style={[styles.button, styles.secondaryButton]} onPress={() => navigation.navigate('Register')}>
        <Text style={styles.buttonText}>INSCRIPTION</Text>
      </TouchableOpacity>

      <TouchableOpacity style={[styles.button, styles.secondaryButton]} onPress={() => navigation.navigate('Dashboard')}>
        <Text style={styles.buttonText}>DASHBOARD</Text>
      </TouchableOpacity>

      <TouchableOpacity style={[styles.button, styles.secondaryButton]} onPress={() => navigation.navigate('Profile')}>
        <Text style={styles.buttonText}>PROFIL</Text>
      </TouchableOpacity>
    </View>
  );
};

export default HomeScreen;