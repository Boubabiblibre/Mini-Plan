import React, { useState, useEffect } from 'react';
import { View, ActivityIndicator } from 'react-native';
import { gestureHandlerRootHOC } from 'react-native-gesture-handler';
import * as Font from 'expo-font';
import { useFonts, Outfit_400Regular, Outfit_700Bold } from '@expo-google-fonts/outfit';
import AppNavigator from './src/navigation/AppNavigator';

export default function App() {
  let [fontsLoaded] = useFonts({
    OutfitRegular: Outfit_400Regular,
    OutfitBold: Outfit_700Bold,
  });

  if (!fontsLoaded) {
    return <ActivityIndicator size="large" />;
  }

  return <AppNavigator />;
}

