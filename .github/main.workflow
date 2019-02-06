workflow "Deploy" {
  resolves = [
    "Hyper Lazer Deployer",
    "PHPStan",
  ]
  on = "push"
}

action "Hyper Lazer Deployer" {
  uses = "docker://louishrg/hyper-lazer-deployer:1.0"
  secrets = [
    "REMOTE",
    "TARGET_FOLDER",
    "REPO_GIT_URL",
    "AFTER_PULL_COMMAND",
    "GITHUB_TOKEN",
  ]
}

action "PHPStan" {
  uses = "docker://oskarstark/phpstan-ga:with-extensions"
  args = "analyse src tests --level max --configuration extension.neon"
  secrets = ["GITHUB_TOKEN"]
}
