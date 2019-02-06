workflow "Code Quality" {
  resolves = [
    "Hyper Lazer Deployer",
    "PHPStan",
  ]
  on = "check_run"
}

action "Hyper Lazer Deployer" {
  uses = "docker://louishrg/hyper-lazer-deployer"
  secrets = ["GITHUB_TOKEN", "REMOTE", "TARGET_FOLDER", "REPO_GIT_URL", "AFTER_PULL_COMMAND"]
}

action "PHPStan" {
  uses = "docker://oskarstark/phpstan-ga:with-extensions"
  args = "analyse src tests --level max --configuration extension.neon"
  secrets = ["GITHUB_TOKEN"]
}
