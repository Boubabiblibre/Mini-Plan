import { StyleSheet } from 'react-native';

const AddSubscriptionStyles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#000', // Fond noir
  },
  header: {
    backgroundColor: '#72CE1D', // Vert
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'flex-start',
    paddingHorizontal: 15,
    paddingVertical: 15,
    borderBottomLeftRadius: 25,
    borderBottomRightRadius: 25,
  },
  backButton: {
    marginRight: 10,
  },
  headerTitle: {
    color: '#fff',
    fontSize: 18,
    fontWeight: 'bold',
  },
  formContainer: {
    paddingHorizontal: 20,
    marginTop: 20,
  },
  label: {
    color: '#72CE1D', // Vert clair
    fontSize: 14,
    marginBottom: 5,
  },
  input: {
    backgroundColor: '#C8B6E2', // Violet clair
    borderRadius: 20,
    paddingHorizontal: 15,
    paddingVertical: 10,
    marginBottom: 15,
    color: '#000', // Texte noir
  },
  // Champ avec l’icône flèche vers le bas
  inputWithIcon: {
    flexDirection: 'row',
    alignItems: 'center',
    marginBottom: 15,
    borderRadius: 20,
    backgroundColor: '#C8B6E2',
  },
  button: {
    backgroundColor: '#72CE1D', // Vert
    borderRadius: 20,
    paddingVertical: 15,
    alignItems: 'center',
    marginTop: 10,
  },
  buttonText: {
    color: '#000',
    fontWeight: 'bold',
    fontSize: 16,
  },
});

export default AddSubscriptionStyles;
