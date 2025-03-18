import { StyleSheet } from 'react-native';

const RegisterStyles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    paddingHorizontal: 20,
    paddingVertical: 30,
    backgroundColor: '#000000',
  },
  title: {
    fontSize: 24,
    fontWeight: 'bold',
    color: '#FFFFFF',
    textAlign: 'center',
    marginBottom: 25,
  },
  label: {
    fontSize: 14,
    fontWeight: 'bold',
    marginBottom: 5, // Moins d'espace pour rester proche de l'input
    color: '#FFFFFF',
  },
  input: {
    marginBottom: 15,
    borderRadius: 25,
    backgroundColor: 'white',
    height: 50,
    paddingHorizontal: 15,
    borderWidth: 1,
    borderColor: '#ccc',
  },
  socialButton: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'center',
    paddingVertical: 12,
    borderRadius: 25,
    marginBottom: 12,
  },
  googleButton: {
    backgroundColor: '#DB4437', // Google Red
  },
  facebookButton: {
    backgroundColor: '#1877F2', // Facebook Blue
  },
  socialButtonText: {
    color: 'white',
    fontSize: 16,
    fontWeight: 'bold',
  },
  separatorContainer: {
    flexDirection: 'row',
    alignItems: 'center',
    marginVertical: 20,
  },
  separator: {
    flex: 1,
    height: 1,
    backgroundColor: '#ccc',
  },
  separatorText: {
    color: '#FFFFFF',
    marginHorizontal: 10,
    fontWeight: 'bold',
  },
  button: {
    marginTop: 25,
    borderRadius: 25,
    height: 50,
    backgroundColor: '#A6FF00',
    justifyContent: 'center',
    alignItems: 'center',
  },
  buttonText: {
    color: 'black',
    fontWeight: 'bold',
    fontSize: 16,
  },
  link: {
    color: 'white',
    alignSelf: 'center',
    marginTop: 15,
    textDecorationLine: 'underline',
  },
});

export default RegisterStyles;
