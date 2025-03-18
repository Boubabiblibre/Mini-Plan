import React from 'react';
import { View, Text, TouchableOpacity, ScrollView } from 'react-native';
import DashboardStyles from '../../styles/DashboardStyles';
import { Ionicons } from '@expo/vector-icons';

const DashboardScreen = () => {
  return (
    <ScrollView style={DashboardStyles.container}>
      {/* Tabs */}
      <View style={DashboardStyles.tabsContainer}>
        <TouchableOpacity style={DashboardStyles.activeTab}><Text style={DashboardStyles.activeTabText}>Vous</Text></TouchableOpacity>
        <TouchableOpacity style={DashboardStyles.inactiveTab}><Text style={DashboardStyles.inactiveTabText}>Cercles</Text></TouchableOpacity>
      </View>
      
      {/* Greeting */}
      <Text style={DashboardStyles.greeting}>Bonjour John</Text>
      
      {/* Dépenses Section */}
      <View style={DashboardStyles.section}>
        <View style={DashboardStyles.sectionHeader}>
          <Text style={DashboardStyles.sectionTitle}>Dépenses</Text>
          <Text style={DashboardStyles.seeMore}>Voir plus</Text>
        </View>
        <View style={DashboardStyles.card}>
          <Text style={DashboardStyles.cardText}><Ionicons name="calendar" size={16} /> Décembre 2024</Text>
          <Text style={DashboardStyles.cardText}><Ionicons name="layers" size={16} /> 12 abonnements</Text>
          <Text style={DashboardStyles.amount}>159.69 € <Text style={DashboardStyles.perMonth}>/mois</Text></Text>
        </View>
      </View>

      {/* Calendrier Section */}
      <View style={DashboardStyles.section}>
        <View style={DashboardStyles.sectionHeader}>
          <Text style={DashboardStyles.sectionTitle}>Calendrier</Text>
          <Text style={DashboardStyles.seeMore}>Voir plus</Text>
        </View>
        <View style={DashboardStyles.calendarContainer}>
          {[25, 26, 27, 28, 29, 30, 31].map((day, index) => (
            <TouchableOpacity key={index} style={day === 25 ? DashboardStyles.selectedDate : DashboardStyles.date}>
              <Text style={day === 25 ? DashboardStyles.selectedDateText : DashboardStyles.dateText}>{day}</Text>
            </TouchableOpacity>
          ))}
        </View>
      </View>
      
      {/* Filtre Section */}
      <View style={DashboardStyles.filterContainer}>
        <TouchableOpacity style={DashboardStyles.activeFilter}><Text style={DashboardStyles.activeFilterText}>Tous</Text></TouchableOpacity>
        <TouchableOpacity style={DashboardStyles.inactiveFilter}><Text style={DashboardStyles.inactiveFilterText}>Mois</Text></TouchableOpacity>
        <TouchableOpacity style={DashboardStyles.inactiveFilter}><Text style={DashboardStyles.inactiveFilterText}>Année</Text></TouchableOpacity>
      </View>
      
      {/* Subscription Section */}
      <View style={DashboardStyles.subscriptionCard}>
        <View style={DashboardStyles.subscriptionLeft}>
          <View style={DashboardStyles.logoBox}><Text style={DashboardStyles.logoText}>Orange</Text></View>
          <View>
            <Text style={DashboardStyles.subscriptionTitle}>Orange telecom</Text>
            <Text style={DashboardStyles.subscriptionDesc}>Services de télécommunication</Text>
          </View>
        </View>
        <Text style={DashboardStyles.subscriptionPrice}>12,90 € <Text style={DashboardStyles.perMonth}>/mois</Text></Text>
      </View>
    </ScrollView>
  );
};

export default DashboardScreen;
