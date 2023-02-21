terraform {
  required_version = ">= 0.14"
  required_providers {
    elasticsearch = {
      source  = "phillbaker/elasticsearch"
      version = ">= 1.5.4"
    }
    local = {
      source  = "hashicorp/local"
      version = ">= 1.4.0"
    }
    random = {
      source  = "hashicorp/random"
      version = ">= 2.2.0"
    }
  }
}

provider "elasticsearch" {
  url      = local.elastic_cluster
  sniff    = false
  username = local.elastic_user
  password = local.elastic_password
}