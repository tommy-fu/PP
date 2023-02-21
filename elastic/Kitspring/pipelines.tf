resource "elasticsearch_ingest_pipeline" "kitshop_pipeline" {
  for_each = fileset("${path.module}/pipelines", "*.json")
  name     = replace(each.key, ".json", "") //Strip .json ending of filename and use that as pipeline name
  body     = file("${path.module}/pipelines/${each.value}")
}