resource "elasticsearch_index_template" "kitshop_template" {
  for_each = fileset("${path.module}/templates", "*.json")
  name     = replace(each.key, ".json", "") //Strip .json ending of filename and use that as template name
  body     = file("${path.module}/templates/${each.value}")
}

resource "elasticsearch_component_template" "kitshop_component_template" {
  for_each = fileset("${path.module}/component-templates", "*.json")
  name     = replace(each.key, ".json", "") //Strip .json ending of filename and use that as component template name
  body     = file("${path.module}/component-templates/${each.value}")
}

resource "elasticsearch_composable_index_template" "kitshop_composable_index_template" {
  for_each = fileset("${path.module}/composable-templates", "*.json")
  name     = replace(each.key, ".json", "") //Strip .json ending of filename and use that as composable template name
  body     = file("${path.module}/composable-templates/${each.value}")

  depends_on = [
    elasticsearch_component_template.kitshop_component_template
  ]
}