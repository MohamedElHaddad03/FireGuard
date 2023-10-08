import axios from "axios";

const BASE_URL = "http://127.0.0.1:8000/";


export const axiosPrivate = axios.create({
  baseURL: BASE_URL,
  headers: { 'Content-Type': 'application/json' },
  withCredentials: true
});


export class ApiCitizen {
  static async fetchChats() {
    const response = await axios.get(`${BASE_URL}api/chats`);
    console.log( response.data);
    return response.data;
  }
}






