"""
Backend tests for KIPL Corporate API
Tests: root, inquiries (create/list/validation), legacy status endpoints
"""
import os
import pytest
import requests

BASE_URL = os.environ.get("REACT_APP_BACKEND_URL", "https://future-dahej-plant.preview.emergentagent.com").rstrip("/")
API = f"{BASE_URL}/api"


@pytest.fixture(scope="module")
def client():
    s = requests.Session()
    s.headers.update({"Content-Type": "application/json"})
    return s


# ---------- Root ----------
class TestRoot:
    def test_root_ok(self, client):
        r = client.get(f"{API}/", timeout=20)
        assert r.status_code == 200
        data = r.json()
        assert data.get("message") == "KIPL API is live"


# ---------- Inquiries ----------
class TestInquiries:
    valid_payload = {
        "name": "TEST Ravi Kumar",
        "email": "test.ravi@example.com",
        "company": "TEST Acme Chemicals",
        "industry": "Pharma",
        "inquiry_type": "Export",
        "message": "We are interested in your pharma intermediates for bulk export.",
    }

    def test_create_inquiry_valid(self, client):
        r = client.post(f"{API}/inquiries", json=self.valid_payload, timeout=20)
        assert r.status_code == 201, r.text
        data = r.json()
        # Verify fields
        assert data["name"] == self.valid_payload["name"]
        assert data["email"] == self.valid_payload["email"]
        assert data["company"] == self.valid_payload["company"]
        assert data["industry"] == self.valid_payload["industry"]
        assert data["inquiry_type"] == "Export"
        assert data["message"] == self.valid_payload["message"]
        assert "id" in data and isinstance(data["id"], str) and len(data["id"]) > 0
        assert "created_at" in data
        assert "_id" not in data  # no Mongo leakage

    def test_create_inquiry_all_allowed_types(self, client):
        for t in ["Export", "Custom Manufacturing", "Product Spec", "General"]:
            p = dict(self.valid_payload)
            p["inquiry_type"] = t
            p["name"] = f"TEST {t}"
            r = client.post(f"{API}/inquiries", json=p, timeout=20)
            assert r.status_code == 201, f"{t}: {r.text}"
            assert r.json()["inquiry_type"] == t

    def test_create_inquiry_invalid_type(self, client):
        p = dict(self.valid_payload)
        p["inquiry_type"] = "Spam"
        r = client.post(f"{API}/inquiries", json=p, timeout=20)
        assert r.status_code == 400, r.text
        assert "inquiry_type" in r.text

    def test_create_inquiry_invalid_email(self, client):
        p = dict(self.valid_payload)
        p["email"] = "not-an-email"
        r = client.post(f"{API}/inquiries", json=p, timeout=20)
        assert r.status_code == 422

    def test_create_inquiry_missing_fields(self, client):
        r = client.post(f"{API}/inquiries", json={"name": "TEST"}, timeout=20)
        assert r.status_code == 422

    def test_list_inquiries_sorted_desc(self, client):
        r = client.get(f"{API}/inquiries", timeout=20)
        assert r.status_code == 200
        items = r.json()
        assert isinstance(items, list)
        assert len(items) >= 1
        # No _id leakage
        for it in items:
            assert "_id" not in it
            assert "id" in it
            assert "created_at" in it
        # Sorted desc by created_at
        timestamps = [it["created_at"] for it in items]
        assert timestamps == sorted(timestamps, reverse=True)

    def test_list_inquiries_honors_limit(self, client):
        r = client.get(f"{API}/inquiries?limit=2", timeout=20)
        assert r.status_code == 200
        items = r.json()
        assert len(items) <= 2


# ---------- Legacy status ----------
class TestStatus:
    def test_create_and_get_status(self, client):
        r = client.post(f"{API}/status", json={"client_name": "TEST_client"}, timeout=20)
        assert r.status_code == 200
        data = r.json()
        assert data["client_name"] == "TEST_client"
        assert "id" in data

        r2 = client.get(f"{API}/status", timeout=20)
        assert r2.status_code == 200
        items = r2.json()
        assert isinstance(items, list)
        assert any(x.get("client_name") == "TEST_client" for x in items)
        for it in items:
            assert "_id" not in it
