workflow "Deploy pls" {
  resolves = [
    "Hyper Lazer Deployer",
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
