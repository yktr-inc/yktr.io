workflow "CI/CD" {
  resolves = [
    "Hyper Lazer Deployer",
  ]
  on = "push"
}

action "branch-filter" {
  uses = "actions/bin/filter@master"
  args = "branch master"
}

action "Hyper Lazer Deployer" {
  needs = "branch-filter"
  uses = "docker://louishrg/hyper-lazer-deployer:1.0"
  secrets = [
    "REMOTE",
    "TARGET_FOLDER",
    "REPO_GIT_URL",
    "AFTER_PULL_COMMAND",
    "GITHUB_TOKEN",
    "RSA_PRIV",
    "RSA_PUB",
  ]
}
