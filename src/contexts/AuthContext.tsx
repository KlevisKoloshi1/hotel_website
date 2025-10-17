import { createContext, useContext, useEffect, useMemo, useState } from "react";
import { fetchJson, getApiBaseUrl } from "@/lib/api";

type AuthContextValue = {
  token: string | null;
  isAuthenticated: boolean;
  login: (email: string, password: string) => Promise<void>;
  register: (firstName: string, lastName: string, email: string, password: string) => Promise<void>;
  logout: () => void;
};

const AuthContext = createContext<AuthContextValue | undefined>(undefined);

export function AuthProvider({ children }: { children: React.ReactNode }) {
  const [token, setToken] = useState<string | null>(() => localStorage.getItem("auth_token"));
  const apiEnabled = Boolean(getApiBaseUrl());

  useEffect(() => {
    if (token) {
      localStorage.setItem("auth_token", token);
    } else {
      localStorage.removeItem("auth_token");
    }
  }, [token]);

  const value = useMemo<AuthContextValue>(() => ({
    token,
    isAuthenticated: Boolean(token),
    async login(email, password) {
      if (!apiEnabled) {
        setToken("dev-token");
        return;
      }
      const res = await fetchJson<{ token: string }>("/auth/login", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ email, password })
      });
      setToken(res.token);
    },
    async register(firstName, lastName, email, password) {
      if (!apiEnabled) {
        setToken("dev-token");
        return;
      }
      const res = await fetchJson<{ token: string }>("/auth/register", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ firstName, lastName, email, password })
      });
      setToken(res.token);
    },
    logout() {
      setToken(null);
    }
  }), [token, apiEnabled]);

  return <AuthContext.Provider value={value}>{children}</AuthContext.Provider>;
}

export function useAuth() {
  const ctx = useContext(AuthContext);
  if (!ctx) throw new Error("useAuth must be used within AuthProvider");
  return ctx;
}


