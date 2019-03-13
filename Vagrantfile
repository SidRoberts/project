VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

	config.vm.box = "ubuntu/bionic64"



	config.vm.synced_folder ".", "/app", :user => "vagrant", :group => "vagrant"



	config.vm.provision "shell" do |shell|
		shell.path = "install.sh"
	end



	config.vm.provider "virtualbox" do |provider|
		provider.memory = 2048
		provider.cpus   = 2
	end



	config.vm.hostname = "pomelo"



	config.vm.network "forwarded_port", guest: 80, host: 8080

	config.vm.network "private_network", type: "dhcp"

end
