workflow "Code Quality" {
  on = "push"
  resolves = [
    "Hyper Lazer Deployer",
  ]
}

action "Hyper Lazer Deployer" {
  uses = "docker://louishrg/hyper-lazer-deployer"
  secrets = ["GITHUB_TOKEN", "REMOTE", "TARGET_FOLDER", "REPO_GIT_URL", "AFTER_PULL_COMMAND"]
}
