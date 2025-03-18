import React from 'react';
import { View, Text, TouchableOpacity, ScrollView, StyleSheet } from 'react-native';
import { Ionicons } from '@expo/vector-icons';

const DashboardScreen = () => {
  return (
    <ScrollView style={styles.container}>
      {/* Tabs */}
      <View style={styles.tabsContainer}>
        <TouchableOpacity style={styles.activeTab}><Text style={styles.activeTabText}>Vous</Text></TouchableOpacity>
        <TouchableOpacity style={styles.inactiveTab}><Text style={styles.inactiveTabText}>Cercles</Text></TouchableOpacity>
      </View>
      
      {/* Greeting */}
      <Text style={styles.greeting}>Bonjour John</Text>
      
      {/* Dépenses Section */}
      <View style={styles.section}>
        <View style={styles.sectionHeader}>
          <Text style={styles.sectionTitle}>Dépenses</Text>
          <Text style={styles.seeMore}>Voir plus</Text>
        </View>
        <View style={styles.card}>
          <Text style={styles.cardText}><Ionicons name="calendar" size={16} /> Décembre 2024</Text>
          <Text style={styles.cardText}><Ionicons name="layers" size={16} /> 12 abonnements</Text>
          <Text style={styles.amount}>159.69 € <Text style={styles.perMonth}>/mois</Text></Text>
        </View>
      </View>

      {/* Calendrier Section */}
      <View style={styles.section}>
        <View style={styles.sectionHeader}>
          <Text style={styles.sectionTitle}>Calendrier</Text>
          <Text style={styles.seeMore}>Voir plus</Text>
        </View>
        <View style={styles.calendarContainer}>
          {[25, 26, 27, 28, 29, 30, 31].map((day, index) => (
            <TouchableOpacity key={index} style={day === 25 ? styles.selectedDate : styles.date}>
              <Text style={day === 25 ? styles.selectedDateText : styles.dateText}>{day}</Text>
            </TouchableOpacity>
          ))}
        </View>
      </View>
      
      {/* Filtre Section */}
      <View style={styles.filterContainer}>
        <TouchableOpacity style={styles.activeFilter}><Text style={styles.activeFilterText}>Tous</Text></TouchableOpacity>
        <TouchableOpacity style={styles.inactiveFilter}><Text style={styles.inactiveFilterText}>Mois</Text></TouchableOpacity>
        <TouchableOpacity style={styles.inactiveFilter}><Text style={styles.inactiveFilterText}>Année</Text></TouchableOpacity>
      </View>
      
      {/* Subscription Section */}
      <View style={styles.subscriptionCard}>
        <View style={styles.subscriptionLeft}>
          <View style={styles.logoBox}><Text style={styles.logoText}>Orange</Text></View>
          <View>
            <Text style={styles.subscriptionTitle}>Orange telecom</Text>
            <Text style={styles.subscriptionDesc}>Services de télécommunication</Text>
          </View>
        </View>
        <Text style={styles.subscriptionPrice}>12,90 € <Text style={styles.perMonth}>/mois</Text></Text>
      </View>
    </ScrollView>
  );
};

export default DashboardScreen;